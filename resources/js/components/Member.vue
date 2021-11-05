<template>
    <div class="row justify-content-center h-100" style="margin: 0px auto;">
        <div class="col-md-7 chat contacts_card">
            <h3 class="text-white">Thành viên</h3>
            <div class="user-info">
                <user
                    v-for="user in members"
                    :key="user.id"
                    :user="user"
                ></user>
            </div>
        </div>
        <div class="col-md-4 chat contacts_card ml-3">
            <h3 class="text-white">Thêm thành viên</h3>
            <multiselect
                v-model="taggingSelected"
                placeholder="Thêm thành viên"
                label="name"
                track-by="id"
                :options="taggingOptions"
                :multiple="true"
                :taggable="true"
            >
            </multiselect>
            <button
                class="btn btn-primary mt-2"
                :class="{ none: isLoading }"
                @click="addUser()"
            >
                Submit
            </button>
        </div>
    </div>
</template>

<script>
import User from "./User.vue";
import axios from "axios";
import Multiselect from "vue-multiselect";
import swal from "sweetalert";

export default {
    name: "Member",
    data() {
        return {
            roomId: this.$route.params.roomId,
            members: [],
            taggingSelected: [],
            taggingOptions: [],
            isLoading: false
        };
    },
    methods: {
        async getMembers() {
            try {
                const res = await axios.get(`/list-member/${this.roomId}`);
                this.members = res.data;
            } catch (error) {
                console.log(error);
            }
        },
        async getUsers() {
            try {
                const res = await axios.get(
                    `/list-users-not-in-room/${this.roomId}`
                );
                this.taggingOptions = res.data;
            } catch (error) {
                console.log(error);
            }
        },
        async addUser() {
            if (this.taggingSelected.length <= 0) {
                swal("Không có thành viên nào để thêm");
            } else {
                try {
                    this.isLoading = true;
                    const res = await axios.post(`/add-member`, {
                        members: this.taggingSelected,
                        roomId: this.roomId
                    });
                    this.taggingOptions.push(this.taggingSelected);
                    this.taggingSelected = [];
                    if (res.data.error) {
                        swal(res.data.error);
                    }
                } catch (error) {
                    console.log(error);
                } finally {
                    this.isLoading = false;
                }
            }
        }
    },
    components: {
        User,
        Multiselect
    },
    created() {
        this.getMembers();
        this.getUsers();
    },
    watch: {
        taggingOptions: function(val) {
            this.getMembers();
            this.getUsers();
        }
    }
};
</script>

<style scoped>
.contacts_card {
    height: 550px;
    border-radius: 15px !important;
    background-color: rgba(0, 0, 0, 0.4) !important;
    padding: 40px 60px;
    overflow-y: scroll;
}
div.user-info {
    padding: 5px auto;
}
.none {
    display: none;
}
</style>
