import Vue from "vue";
import VueRouter from "vue-router";
import ListRoom from "./pages/ListRoom";
import Room from "./pages/Room";
import AddGroup from "./components/AddGroup";
import EditGroup from "./components/EditGroup";
import Profile from "./components/Profile";
import Member from "./components/Member"

Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        name: "list.room",
        component: ListRoom
    },
    {
        path: "/rooms/:roomId",
        name: "room",
        component: Room
    },
    {
        path: "/add-room",
        name: "add.room",
        component: AddGroup
    },
    {
        path: "/edit-room/:roomId",
        name: "edit.room",
        component: EditGroup
    },
    {
        path: "/member/:roomId",
        name: "member.room",
        component: Member
    },
    {
        path: "/home",
        name: "home",
        component: Profile
    }
];

const router = new VueRouter({
    mode: "history",
    routes
});

export default router;
