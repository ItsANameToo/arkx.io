<template>
    <div class="flex items-center justify-between p-6 rounded-sm mt-3" :class="currentClass" @click="toggle">
        <p class="text-blue-medium w-1/2" v-html="message"></p>

        <ul class="list-reset flex justify-between">
            <li class="mr-6" v-if="isUnread">
                <i class="far fa-bell text-green"></i>
            </li>

            <li class="mr-6 text-sm date">
                {{ date }}
            </li>

            <li>
                <i class="far text-green-darkest" :class="{
                    'fa-angle-up': this.open,
                    'fa-angle-down': !this.open
                }"></i>
            </li>
        </ul>
    </div>
</template>

<script type="text/ecmascript-6">
    import truncate from 'lodash/truncate'
    import moment from 'moment'
    import showdown from 'showdown'

    export default {
        props: {
            notification: {
                type: Object,
                required: true
            }
        },
        data () {
            return {
                open: false
            }
        },
        computed: {
            currentClass () {
                if (this.open) {
                    return 'notification-reading'
                }

                return this.notification.read_at ? 'notification-read' : 'notification-unread'
            },
            isUnread () {
                return !this.notification.read_at && !this.open
            },
            message () {
                if (this.open) {
                    const converter = new showdown.Converter()

                    return converter.makeHtml(this.notification.data.message)
                }

                return truncate(this.notification.data.message)
            },
            date () {
                return moment(this.notification.created_at).format('MMMM Do YYYY, h:mm:ss A')
            },
            status () {
                return this.notification.read_at ? 'read' : 'unread'
            }
        },
        methods: {
            async toggle () {
                this.open = !this.open

                await axios.post(`/dashboard/notifications/${this.notification.id}/mark-as-read`)

                this.notification.read_at = true
            }
        }
    }
</script>
