<template>
    <div class="mb-3 ms-3">
        <div class="d-flex justify-content-between mb-1">
            <div>{{reply.user.email}}</div>
            <div>{{new Intl.DateTimeFormat('ru-RU').format(new Date(reply.created_at))}}</div>
        </div>
        <div class="">
            {{reply.text}}
        </div>
    </div>
</template>

<script>

export default {
    name: 'CommentReply',
    components: {

    },
    props: ['reply'],

    setup(props) {

    }
}
</script>
