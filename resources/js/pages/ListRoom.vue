<template>
    <div class="row justify-content-center h-100">
        <div class="col-md-8 chat">
            <div class="card mb-sm-3 mb-md-0 contacts_card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="d-flex text-white">
                            Nhóm trò chuyện
                            <span class="badge badge-success ml-2">{{
                                $root.rooms.length
                            }}</span>
                        </h3>
                        <router-link
                            tag="a"
                            :to="{ name: 'add.room' }"
                            class="mr-2 add-room"
                        >
                            <span class="text-white add-room-icon"
                                ><i class="fas fa-plus"></i
                            ></span>
                        </router-link>
                    </div>

                    <div class="input-group">
                        <input
                            v-model="searchQuery"
                            type="text"
                            placeholder="Search..."
                            name=""
                            class="form-control search"
                        />
                        <div class="input-group-prepend">
                            <span class="input-group-text search_btn"
                                ><i class="fas fa-search"></i
                            ></span>
                        </div>
                    </div>
                </div>
                <div class="card-body contacts_body">
                    <div class="contacts">
                        <li v-for="room in tempRooms" :key="room.id">
                            <div
                                class="d-flex justify-content-between bd-highlight"
                            >
                                <router-link
                                    :to="`/rooms/${room.id}`"
                                    class="text-bolder"
                                >
                                    <div class="user_info">
                                        <span>{{ room.name }}</span>
                                        <p v-if="room.description">
                                            {{ room.description }}
                                        </p>
                                    </div>
                                </router-link>

                                <!-- <span class="text-white"><i class="fas fa-trash-alt"></i></span> -->
                                <div class="d-flex align-items-center">
                                    <div class="dropdown mr-1">
                                        <span
                                            class="more-action"
                                            id="more-action"
                                            data-toggle="dropdown"
                                        >
                                            <span class="text-white"><i class="fas fa-ellipsis-v"></i></span>
                                        </span>
                                        <div class="dropdown-menu" aria-labelledby="more-action">
                                            <router-link class="dropdown-item" tag="a" :to="{ name: 'edit.room', params: {roomId: room.id } }">
                                                <span><i class="fas fa-edit"></i> Chỉnh sửa</span>
                                            </router-link>
                                            <a class="dropdown-item" href="javascript-void(0)" onclick="return false;" @click="deleteRoom(room.id)">
                                                <span><i class="fas fa-trash-alt"></i> Xóa group</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </div>
                </div>
            </div>
        </div>
        <!-- <add-group v-bind="isOpen"></add-group> -->
    </div>
</template>

<script>
import axios from "axios";
import swal from 'sweetalert';

export default {
    data() {
        return {
            searchQuery: "",
            rooms: {},
            tempRooms: {}
        };
    },
    // computed: {
    //     filteredRooms() {
    //         const searchQueryClean = this.searchQuery.trim().toLowerCase();
    //         return this.rooms.filter(item =>
    //             item.name.toLowerCase().includes(searchQueryClean)
    //         );
    //     }
    // },
    methods: {
        async getRooms() {
            try {
                const res = await axios.get(`get-rooms`);
                this.rooms = res.data;
                this.tempRooms = res.data;
            } catch (error) {
                console.log(error);
            }
        },
        async deleteRoom(id){
            try{
                const res = await axios.post(`delete-room`, {
                    id: id
                });
                console.log(res);
            } catch (error) {
                console.log(error)
            } finally {
                swal("Success!", "Xóa group chat thành công!", "success");
                this.getRooms();
            }
        },
    },
    created() {
        this.getRooms();
    },
    watch: {
        searchQuery: function(val) {
            const searchQueryClean = val.trim().toLowerCase();
            this.tempRooms = this.rooms.filter(item =>
                item.name.toLowerCase().includes(searchQueryClean)
            );
        }
    }
};
</script>

<style scoped>
.more-action{
    background-color: rgb(75, 117, 233);
}

.more-action:hover{
    background-color: rgb(31, 86, 238);
}

.add-room{
    text-align: center;
    padding: auto 0px;
}

.add-room-icon{
    display: block;
    height: 25px;
    width: 25px;
    background-color: rgb(66, 70, 114);
    border-radius: 50%;
}

.add-room-icon:hover{
    display: block;
    height: 25px;
    width: 25px;
    background-color: rgb(31, 36, 75);
    border-radius: 50%;
}

span.more-action{
    display: block;
    width: 25px;
    height: 25px;
    background-color: rgb(66, 70, 114);
    border-radius: 75%;
    text-align: center;
}

span.more-action:hover{
    display: block;
    width: 25px;
    height: 25px;
    background-color: rgb(31, 36, 75);
    border-radius: 50%;
    text-align: center;
}
</style>
