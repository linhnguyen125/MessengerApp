<template>
    <div
        class="row justify-content-center h-100 w-75"
        style="margin: 0px auto;"
    >
        <div class="col-md-8 chat contacts_card">
            <h3>Chỉnh sửa phòng chat</h3>
            <form @submit="editRoom">
                <div class="form-group">
                    <label for="name">Tên phòng</label>
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        v-model="name"
                    />
                </div>
                <div class="form-group">
                    <label for="description">Mô tả phòng</label>
                    <input
                        type="text"
                        class="form-control"
                        id="description"
                        v-model="description"
                    />
                </div>
                <div class="row">
                    <div class="form-group col-md-9">
                        <label for="thumbnail">Ảnh đại diện</label>
                        <input
                            type="file"
                            class="form-control-file"
                            id="thumbnail"
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

export default {
    name: "EditGroup",
    data() {
        return {
            name: "",
            description: "",
            image: "",
            roomId: this.$route.params.roomId,
            isLoading: false
        };
    },
    methods: {
        async getRoom() {
            try {
                const res = await axios.get(`${this.roomId}`);
                console.log(res.data);
                this.name = res.data.name;
                this.description = res.data.description;
                this.image = res.data.thumbnail;
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
        async editRoom(event) {
            event.preventDefault();
            try {
                this.isLoading = true;
                const res = await axios.post(`${this.roomId}`, {
                    name: this.name,
                    description: this.description,
                    thumbnail: this.image
                });
                console.log(res);
            } catch (error) {
                console.log(error);
            } finally {
                this.isLoading = false;
                swal("Success!", "Chỉnh sửa phòng chat thành công!", "success");
            }
        }
    },
    created() {
        this.getRoom();
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
