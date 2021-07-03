<template>
    <div class="is-clearfix">
        <div :id="id" class="notification is-info is-pulled-left">
            <small>{{ nickname }}: </small>
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
        'nickname',
        'created_at'
    ]
}
</script>

<style scoped>
    small {
        color: #ccc;
        font-size: 0.7em;
    }
    .date {
        width: 100%;
        text-align: left;
        color: #ccc;
        margin-top: 8px;
        font-size: 0.5em;
    }
    .container .notification {
        max-width: 80%;
        margin-bottom: 1em;
        font-size: 1.2em;
        line-height: 1.3;
        padding: 0.5rem 2rem 0.5rem 1rem;
    }
</style>
