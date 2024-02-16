<template>
    <form action="" @submit="submitComment" @updateComments="updateComments">
        <textarea name="" id="" cols="30" rows="3" class="form-control mb-2" v-model="commentText"></textarea>
        <button class="btn btn-success" type="submit">Отправить</button>
    </form>
</template>

<script>
import {reactive, toRefs} from "vue";
import api from "../../api/index.js";
import {useRoute} from "vue-router";

export default {
    name: 'CommentForm',
    components: {

    },
    props: ['id'],

    setup(props, context) {
        const route = useRoute()
        const newsId = route.params.id

        const state = reactive({
            commentText: '',
        })

        const submitComment = (e) => {
            e.preventDefault()
            const user = JSON.parse(localStorage.getItem('user'))
            api.post('/api/comments',{
                parent_id: props.id ? props.id : null,
                news_id: newsId,
                text: state.commentText
            }).then((res) => {
                state.commentText = ''
                context.emit('addNewComment', res.data)
            })
        }

        return {
            ...toRefs(state),
            submitComment,
        }
    }
}
</script>
