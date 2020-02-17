<template>
    <div>
        <p>
            {{ message }}
        </p>
        <time>{{ datetimePost }}</time>
    </div>
</template>
<script>
    import moment from 'moment';

    export default {
        name: "messagechat",
        props: [
            'message',
        ],
        data() {
            return {
                datetimePost: moment().format('H:mm:ss')
            }
        }
    }
</script>

<style scoped>

</style>