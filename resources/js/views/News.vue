<template>
    <Header></Header>
    <div class="container">
        <h1 class="mb-3">{{news.title}}</h1>
        <div class="row">
            <div class="col" >
                <img :src="`/storage/${news.photo}`" alt="">
                <div>{{news.description}}</div>
            </div>
        </div>
        <Comments/>
    </div>
</template>

<script>
import {reactive, onMounted, toRefs} from "vue";
import { useRoute } from 'vue-router'
import Header from "../components/Header.vue";
import Comments from "../components/Comments/Comments.vue";
import api from "../api/index.js";
export default {
    name: 'News',
    components: {
        Header,
        Comments
    },
    setup(props) {
        const route = useRoute()
        const id = route.params.id

        const state = reactive({
            news: {},
        })

        onMounted(() => {
            api.get(`/api/news/${id}`).then((res) => {
                state.news = res.data;
                console.log(res);
            })
        })

        return {
            ...toRefs(state),
        }
    }
}
</script>
