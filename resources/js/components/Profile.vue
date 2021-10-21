<template>
    <div
        class="row justify-content-center h-100 w-75"
        style="margin: 0px auto;"
    >
        <div class="col-md-8 chat contacts_card">
            <h3>Thông tin cá nhân</h3>
            <form @submit="updateProfile" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Tên</label>
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        v-model="name"
                    />
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        type="text"
                        class="form-control"
                        id="email"
                        readonly
                        v-model="email"
                    />
                </div>
                <div class="row">
                    <div class="form-group col-md-9">
                        <label for="avatar">Ảnh đại diện</label>
                        <input
                            type="file"
                            class="form-control-file"
                            id="avatar"
                            ref="file"
                            v-on:change="onFileChange"
                        />
                    </div>
                    <div v-if="image" class="col-md-3">
                        <img
                            :src="image"
                            class="img-response"
                            height="70px"
                            width="auto"
                        />
                    </div>
                </div>
                <button
                    type="submit"
                    class="btn btn-primary"
                    :class="{ none: isLoading }"
                >
                    Submit
                </button>
                <div
                    class="spinner-border text-primary ml-2"
                    :class="{ none: !isLoading }"
                    role="status"
                >
                    <span class="sr-only">Loading...</span>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import swal from "sweetalert";

export default {
    name: "Profile",
    data() {
        return {
            id: "",
            name: "",
            email: "",
            image: "",
            isLoading: false
        };
    },
    methods: {
        async getProfile() {
            try {
                const res = await axios.get(`/home`);
                console.log(res.data);
                this.id = res.data.id;
                this.name = res.data.name;
                this.email = res.data.email;
                this.image = res.data.avatar;
            } catch (error) {
                console.log(error);
            }
        },
        onFileChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length) return;
            this.createImage(files[0]);
        },
        createImage(file) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = e => {
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        async updateProfile(event) {
            event.preventDefault();
            try {
                this.isLoading = true;
                const res = await axios.post(`/update/${this.id}`, {
                    name: this.name,
                    avatar: this.image
                });
                console.log(res);
            } catch (error) {
                console.log(error);
            } finally {
                this.isLoading = false;
                swal("Success!", "Chỉnh sửa thông tin thành công", "success");
            }
        }
    },
    created() {
        this.getProfile();
    }
};
</script>

<style scoped>
.none {
    display: none;
}

.contacts_card {
    /* height: 350px; */
    border-radius: 15px !important;
    background-color: rgba(0, 0, 0, 0.4) !important;
    padding: 40px 60px;
}
</style>
