<template>
    <div
        class="row justify-content-center h-100 w-75"
        style="margin: 0px auto;"
    >
        <div class="col-md-8 chat">
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
            roomId: this.$route.params.roomId,
            isLoading: false
        };
    },
    methods: {
        async getRoom(){
            try {
                const res = await axios.get(`${this.roomId}`);
                console.log(res.data);
                this.name = res.data.name;
                this.description = res.data.description;
            } catch (error) {
                console.log(error);
            }
        },
        async editRoom(event) {
            event.preventDefault();
            try {
                this.isLoading = true;
                const res = await axios.post(`${this.roomId}`, {
                    name: this.name,
                    description: this.description
                });
                console.log(res.message);
            } catch (error) {
                console.log(error);
            } finally {
                this.isLoading = false;
                swal("Success!", "Chỉnh sửa phòng chat thành công!", "success");
            }
        }
    },
    created(){
        this.getRoom();
    }
};
</script>

<style scoped>
.none {
    display: none;
}
</style>
