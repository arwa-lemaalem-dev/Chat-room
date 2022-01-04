require("./bootstrap");

window.Vue = require("vue");
import axios from "axios";
import { get } from "lodash";
import Vue from "vue";
import VueChatScroll from "vue-chat-scroll";
import Nl2br from "vue-nl2br";

Vue.component("nl2br", Nl2br);
Vue.use(VueChatScroll);
Vue.component("new-msg", require("./components/NewMsg.vue").default);

const app = new Vue({
    el: "#app",
    data: {
        user: (Vue.prototype.$userId = document
            .querySelector("meta[name='user-id']")
            .getAttribute("content")),
        id: new URLSearchParams(window.location.search).get("id"),
        quantity: 0,
        cost: 0,
        price: 0,
        total: 0,
        message: "",
        chat: {
            message: [],
            user: [],
            color: [],
            time: [],
            image: [],
            offre: [],
            idoffre: [],
        },
        typing: "",
    },
    watch: {
        message() {
            Echo.private("chat_room").whisper("typing", {
                name: this.message,price:this.price
            });
        },
    },
    methods: {
        sendOffer() {
            if (this.quantity != 0 && this.cost != 0 && this.price != 0) {
                this.total =
                    parseInt(this.quantity) * parseInt(this.price) +
                    parseInt(this.cost);
                this.message =
                    "Quantity : " +
                    this.quantity +
                    "\n\nPrice per item : " +
                    this.price +
                    "\n\nDelivery cost : " +
                    this.cost +
                    "\n\nTotal Price : " +
                    this.total;

                this.chat.message.push(this.message);
                this.chat.user.push("You");
                this.chat.image.push("default.jpg");
                this.chat.color.push("right");
                this.chat.time.push(this.getTime());
                this.chat.offre.push("yes");
                axios
                    .post("/sendMsg", {
                        message: this.message,
                        user: this.id,
                        offre: "yes",
                    })
                    .then((response) => {
                        this.chat.idoffre.push(response.data);
                        this.total = 0;
                        this.cost = 0;
                        this.price = 0;
                        this.quantity = 0;
                        this.message = "";
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },
        send() {
            if (this.message.length != 0) {
                this.chat.message.push(this.message);
                this.chat.user.push("You");
                this.chat.image.push("default.jpg");
                this.chat.color.push("right");
                this.chat.time.push(this.getTime());
                this.chat.offre.push("no");
                axios
                    .post("/sendMsg", {
                        message: this.message,
                        user: this.id,
                        offre: "no",
                    })
                    .then((response) => {
                        // console.log(response.data);
                        this.message = "";
                        this.chat.idoffre.push(response.data);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },
        getTime() {
            let time = new Date();
            return (
                time.getFullYear() +
                "-" +
                time.getMonth() +
                "-" +
                time.getDay() +
                " " +
                time.getHours() +
                ":" +
                time.getMinutes() +
                ":" +
                time.getSeconds()
            );
        },
    },
    computed: {
        styleTyping() {
            if (this.typing == "") {
                return "visibility:hidden";
            } else {
                return "visibility:visible";
            }
        },
    },
    mounted() {
        //recevoir un message en temps reel
        Echo.private("chat_room")
            .listen("ChatEvent", (e) => {
                console.log("ggg");
                if (this.id == e.from_user.id && e.to_user.id == this.user) {
                    // console.log('id: ' + this.id + 'to_user: ' + e.to_user.id + 'from_user : ' + e.from_user.id + 'user : ' + this.user);
                    this.chat.message.push(e.message);
                    this.chat.user.push(e.to_user.name);
                    this.chat.color.push("direct-chat-msg");
                    this.chat.time.push(this.getTime());
                    this.chat.image.push(e.to_user.avatar);
                    this.chat.offre.push(e.offre);
                    this.chat.idoffre.push(e.idoffre);
                }
            })
            .listenForWhisper("typing", (e) => {
                if (e.name != "" ) {
                    this.typing = "Typing...";
                } else {
                    this.typing = "";
                }
            });
    },
});
