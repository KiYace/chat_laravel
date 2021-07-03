<template>
    <div>
        <div id="chat-box" class="box">
            <p v-if="!messages.length">История чата</p>

            <div v-for="message in messages">
                <my-message
                    v-if="message.nickname == nickname"
                    :id="message.id"
                    :message="message.message"
                    :created_at="message.created_at"
                ></my-message>

                <message
                    v-if="message.nickname != nickname"
                    :id="message.id"
                    :message="message.message"
                    :nickname="message.nickname"
                    :created_at="message.created_at"
                ></message>
            </div>
        </div>

        <form @submit.prevent="submit">
            <div class="field has-addons has-addons-fullwidth">
                <div class="control is-expanded">
                    <input class="input" type="text" placeholder="Введите сообщение..." v-model="newMessage">
                </div>
                <div class="control">
                    <button type="submit" class="button is-danger" :disabled="!newMessage">
                        Отправить
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data () {
        return {
            nickname: '',
            messages: [],
            newMessage: ''
        }
    },
    mounted () {
        if (!localStorage.nickname) {
            localStorage.nickname = prompt('Введите ваш никнейм');
        }
        this.nickname = localStorage.nickname;
        this.loadData();
        Echo.channel('chat')
            .listen('ChatMessage', (e) => {
                this.messages.push({
                    id: e.id,
                    message: e.message,
                    nickname: e.nickname,
                    created_at: e.created_at
                });
            });
    },
    updated () {
        let lastMessage = this.messages[this.messages.length - 1];
        if (lastMessage) {
            let block = document.getElementById(lastMessage.id);
            block.scrollIntoView();
        }
    },
    methods: {
        loadData() {
            axios.get(`/api/message`).then((response) => {
                this.messages = response.data.data;
                this.newMessage = '';
            }, (error) => {
                alert(error);
            });
        },
        submit() {
            axios.post(`/api/message`, {
                nickname: this.nickname,
                message: this.newMessage
            }).then((response) => {
                this.newMessage = '';
            }, (error) => {
                alert(error);
            });
        }
    }
}
</script>

<style scoped>
    .box {
        height: 600px;
        overflow-y: scroll;
        background-image: url("../images/background.png");
        background-size: cover;
        background-repeat: no-repeat;
    }
</style>
