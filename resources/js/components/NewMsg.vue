<template>
    <li>
        <div class="direct-chat-msg" :class="className">
            <div class="direct-chat-infos clearfix">
                <span class="direct-chat-name" :class="float1">{{ user }}</span>
                <span class="direct-chat-timestamp" :class="float2">{{
                    time
                }}</span>
            </div>
            <img :src="'/dist/img/' + image" class="direct-chat-img" alt="" />
            <div style="white-space: pre-line" class="direct-chat-text">
                <slot></slot><a class="icon" :href="'pdfOffre/' + idoffre"
                    ><i class="bi bi-printer" :style="offreStyle"></i
                ></a>
            </div>
        </div>
    </li>
</template>
<script>
export default {
    props: ["color", "user", "time", "image", "offre", "idoffre", "message"],
    computed: {
        className() {
            return this.color;
        },
        float1() {
            return "float-" + this.color;
        },
        float2() {
            if (this.color == "right") {
                return "float-left";
            } else {
                return "float-right";
            }
        },
        offreStyle() {
            if (this.offre == "no") {
                return "visibility:hidden";
            } else {
                return "float:right;visibility:visible";
            }
        },
    },
    mounted() {
        console.log(this.idoffre);
    },
};
</script>
