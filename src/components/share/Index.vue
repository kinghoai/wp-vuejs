<template>
    <div>
        <div v-for="(post, index) in post_data" :key="index">
            <h1>
                <router-link :to="{name:'single', params: {name: post.slug}}">{{post.title.rendered}}</router-link>
            </h1>
            <div v-html="post.excerpt.rendered"></div>
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
                axios.get(rtwp.root + "wp/v2/posts").then(
                    response => {
                        this.post_data = response.data;
                    }
                ).catch(

                );
            }
        }
    }
</script>