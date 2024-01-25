<template>
    <Header></Header>
    <div class="container">
        <h1 class="mb-3">News</h1>
        <div class="row">
            <div class="col-4" v-for="news in newses">
                <router-link :to="`news/${news.id}`" class="d-block mb-4 text-black">
                    <div class="h2 text-truncate">{{news.title}}</div>
                    <div class="mb-2">
                        <img :src="`/storage/${news.photo}`" alt="" class="w-100">
                    </div>
                    <div>{{news.description}}</div>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
import {reactive, onMounted, toRefs} from "vue";
import Header from "../components/Header.vue";
import api from "../api/index.js";
export default {
    name: 'Home',
    components: {
        Header
    },
    setup(props) {

        const state = reactive({
            newses: [],
        })

        onMounted(() => {
            api.get(`/api/news`).then((res) => {
                state.newses = res.data;
                console.log(res);
            })
        })

        return {
            ...toRefs(state),
        }
    }
}
</script>
