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
                            class="mr-2"
                        >
                            <span class="text-white"
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
                            <router-link
                                :to="`/rooms/${room.id}`"
                                class="text-bolder"
                            >
                                <div class="d-flex bd-highlight">
                                    <div class="user_info">
                                        <span>{{ room.name }}</span>
                                        <p v-if="room.description">
                                            {{ room.description }}
                                        </p>
                                    </div>
                                </div>
                            </router-link>
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
        }
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
