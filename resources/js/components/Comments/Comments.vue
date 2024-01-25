<template>
    <div>
        <h2 class="h2 my-3">Comments</h2>
        <CommentItem v-for="comment in comments" :comment="comment" :key="comment.id"/>
        <label class="mt-2 form-label">Оставить коментарий</label>
        <CommentForm @addNewComment="addNewComment"/>
    </div>
</template>

<script>
import {reactive, onMounted, toRefs} from "vue";
import { useRoute } from 'vue-router'
import CommentItem from "./CommentItem.vue";
import CommentForm from "./CommentForm.vue";
import api from "../../api/index.js";

export default {
    name: 'Comments',
    components: {
        CommentItem,
        CommentForm
    },
    setup(props) {
        const route = useRoute()
        const newsId = route.params.id

        const state = reactive({
            comments: [],
        })

        onMounted(() => {
            api.get(`/api/comments/${newsId}`).then((res) => {
                state.comments = res.data;
            })
        })

        const addNewComment = (comment) => {
            state.comments.push(comment);
        }

        return {
            ...toRefs(state),
            addNewComment
        }
    }
}
</script>
