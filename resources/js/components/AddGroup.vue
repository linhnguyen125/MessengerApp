<template>
    <div
        class="row justify-content-center h-100 w-75"
        style="margin: 0px auto;"
    >
        <div class="col-md-8 chat">
            <form @submit="addRoom">
                <div class="form-group">
                    <label for="name">Tên group</label>
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        v-model="name"
                    />
                </div>
                <div class="form-group">
                    <label for="description">Mô tả group</label>
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
    name: "AddGroup",
    data() {
        return {
            name: "",
            description: "",
            isLoading: false
        };
    },
    methods: {
        async addRoom(event) {
            event.preventDefault();
            try {
                this.isLoading = true;
                const res = await axios.post(`/add-room`, {
                    name: this.name,
                    description: this.description
                });
                console.log(res.message);
            } catch (error) {
                console.log(error);
            } finally {
                this.isLoading = false;
                this.$router.push({ name: "list.room" });
            }
        }
    }
};
</script>

<style scoped>
.none {
    display: none;
}
</style>
