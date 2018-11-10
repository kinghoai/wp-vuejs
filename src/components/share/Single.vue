<template>
    <div>
        <div v-for="(post, index) in post_data" :key="index">
            <img :src="post.featured_img_url" alt="">
            <h1>{{post.title.rendered}}</h1>
            <div class="content">
                <div v-html="post.content.rendered"></div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from "axios"
    export default {
        data(){
            return{
                post_data: [],
            }
        },
        created(){
            this.get_data();
        },
        methods:{
            get_data(){
                axios.get(rtwp.root + "wp/v2/posts?slug="+this.$route.params.name).then(
                    response => {
                        this.post_data = response.data;
                    }
                ).catch(

                );
            }
        }
    }
</script>