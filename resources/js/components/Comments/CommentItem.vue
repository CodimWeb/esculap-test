<template>
    <div class="mb-3">
        <div class="d-flex justify-content-between mb-1">
            <div>{{comment.user.email}}</div>
            <div>{{new Intl.DateTimeFormat('ru-RU').format(new Date(comment.created_at))}}</div>
        </div>
        <div class="">
            <p>{{comment.text}}</p>
            <div class="mb-3 fw-bold" @click="toggleForm" style="cursor: pointer">{{toggleForm ? 'Ответить' : 'Скрыть'}}</div>
            <div class="mb-2" v-if="isShowForm" >
                <CommentForm :id="comment.id" @addNewComment="addNewComment"/>
            </div>
            <CommentReply v-for="reply in comment.replies" :reply="reply"/>
        </div>
        <hr>
    </div>
</template>

<script>

import CommentReply from "./CommentReply.vue";
import CommentForm from "./CommentForm.vue";
import {reactive, toRefs} from "vue";
export default {
    name: 'CommentItem',
    components: {
        CommentReply,
        CommentForm
    },
    props: ['comment'],

    setup(props) {

        console.log(props.comment)
        const state = reactive({
            isShowForm: false,
        })

        const toggleForm = () => {
            state.isShowForm = !state.isShowForm
        }

        const addNewComment = (reply) => {
            props.comment.replies.push(reply)
            state.isShowForm = false
        }

        return {
            ...toRefs(state),
            toggleForm,
            addNewComment
        }
    }
}
</script>
