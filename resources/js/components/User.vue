<template>
    <div class="user d-flex justify-content-between chat-info">
        <div class="d-flex">
            <div class="thumbnail">
                <img
                    class="rounded-circle img-thumbnail"
                    :src="`${user.avatar}`"
                />
            </div>
            <div class="d-flex flex-column">
                <div class="user_info">
                    <span
                        >{{ user.name }}
                        <p class="user-created" v-if="user.id == userCreated">
                            (Chủ phòng)
                        </p></span
                    >
                </div>
                <div class="description text-white ml-3">
                    {{ user.email }}
                </div>
            </div>
        </div>
        <div>
            <span
                v-if="user.id != userCreated"
                class="delete text-white"
                @click="deleteUser(user.id)"
                ><i class="fas fa-user-slash"></i
            ></span>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import swal from "sweetalert";

export default {
    name: "User",
    props: {
        user: Object
    },
    data() {
        return {
            roomId: this.$route.params.roomId,
            userCreated: null
        };
    },
    methods: {
        async deleteUser(id) {
            try {
                const res = await axios.post(`/delete-member`, {
                    id: id,
                    roomId: this.roomId
                });
                if (res.data.error) {
                    swal(res.data.error);
                }
            } catch (error) {
                console.log(error);
            }
        },
        async getUserCreated() {
            try {
                const res = await axios.get(`/user-created/${this.roomId}`);
                this.userCreated = res.data;
            } catch (error) {
                console.log(error);
            }
        }
    },
    created() {
        this.getUserCreated();
    }
};
</script>

<style>
div.user {
    padding: 5px 15px;
}

p.user-created {
    display: inline;
    font-size: 12px;
}

div.user:hover {
    background-color: rgba(59, 59, 59, 0.4) !important;
    border-radius: 15px !important;
}
img.img-thumbnail {
    width: 35px;
    height: 35px;
    padding: 1px !important;
}
div.chat-info {
    align-items: center;
}
div.thumbnail {
    padding-top: 5px;
}
div.user_info {
    font-size: 14px;
}
div.description {
    font-size: 10px;
}
span.delete:hover {
    color: rgb(214, 185, 55) !important;
}
</style>
