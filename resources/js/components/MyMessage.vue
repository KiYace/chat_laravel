<template>
    <div class="is-clearfix">
        <div :id="id" class="notification is-primary is-pulled-right">
            <div>{{ message }}</div>
            <div class="date">{{ created_at }}</div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'id',
        'message',
        'created_at'
    ]
}
</script>

<style scoped>
    .container .notification {
        max-width: 80%;
        text-align: right;
        margin-bottom: 1em;
        font-size: 1.2em;
        padding: 0.5rem 1rem 0.5rem 1rem;
    }
    .date {
        width: 100%;
        text-align: right;
        color: #ccc;
        margin-top: 8px;
        font-size: 0.5em;
    }
    .notification {
        background-color: orchid;
    }
</style>
