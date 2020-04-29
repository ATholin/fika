<template>
    <div>
        <div v-if="this.isFika" class="rainbow rainbow_text_animated font-black text-6xl">
            {{ this.timeString }}
        </div>
        <div v-if="this.isSoonFika" class="font-black text-3xl text-gray-800">
            {{ this.timeString }}
        </div>
        <div v-if="!this.isFika && !this.isSoonFika" class="font-black text-6xl text-center text-gray-800">
            {{ this.timeString }}
        </div>
    </div>
</template>

<script>
    import moment from 'moment-timezone'

    export default {
        name: 'Timer',
        props: {
            slug: String,
        },
        data() {
            return {
                timeString: 'Not yet.',
                isFika: false,
                isSoonFika: false,
                time: {
                    start: moment.prototype,
                    end: moment.prototype
                }
            }
        },
        created() {
            this.getTimes();
        },
        methods: {
            timer() {
                let now = moment();
                this.isFika = false;
                this.isSoonFika = false;

                if (now.isBetween(this.time.start.clone().subtract(5, 'minutes'), this.time.start)) {
                    const diff = moment.duration(this.time.start.diff(now));
                    this.isSoonFika = true
                    if (diff.minutes()) {
                        this.timeString = `No, but in ${diff.minutes()} minutes and ${diff.seconds()} seconds`;
                    } else {
                        this.timeString = `No, but in ${diff.seconds()} seconds`;
                    }
                } else if (now.isBetween(this.time.start, this.time.end)) {
                    this.timeString = 'YES';
                    this.isFika = true;
                } else {
                    this.timeString = 'Not yet.';
                }

                requestAnimationFrame(this.timer)
            },
            getTimes() {
                window.axios
                    .get(this.slug + '/times')
                    .then(res => res.data)
                    .then(data => {
                        this.time = {
                            start: moment.tz(data[0].start, ['h:m a', 'H:m'], 'Europe/Stockholm'),
                            end: moment(data[0].end, ['h:m a', 'H:m'], 'Europe/Stockholm'),
                        }

                        this.timer();
                    });
            }
        }
    }
</script>
