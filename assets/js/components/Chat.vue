<template>
    <div>
        <div>
            <span v-for="m in messages">
                <message-chat :message="m.message"></message-chat>
            </span>
        </div>
        <div>
            <form @submit="submitMessage">
                <input type="text" v-model='messageEnCours' class="form-control" placeholder="Say something">
                <button type="submit">Send</button>
            </form>
        </div>
    </div>
</template>

<script>
    import MessageChat from "./MessageChat";

    export default {
        name: "chat",
        components: {MessageChat},
        data() {
            return {
                messages: [
                    {message: 'Salut, ça va ?'},
                    {message: 'ça biche et toi ?'}
                ],
                messageEnCours: ''
            }
        },
        mounted: function () {
            const url = new URL('http://localhost:3000/.well-known/mercure');
            url.searchParams.append('topic', 'http://chat.localhost');
            const eventSource = new EventSource(url);

            eventSource.onmessage = e => {
                console.log('Nouveau message');
                const data = JSON.parse(e.data);
                this.messages.push({message: data.message});
                this.messageEnCours = '';
            }
        }
        ,
        methods: {
            submitMessage: function (e) {

                const postData = JSON.stringify({message: this.messageEnCours});
                const param = {
                    method: "POST",
                    body: postData
                };

                fetch('/publish', param)
                    .then(data => {
                        console.log('Ils sont partiiiiiss !!!!');
                    })
                    .catch(error => console.log(error));

                e.preventDefault();
            }

        }
    }
</script>

<style scoped>

</style>