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
                times: []
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

                const beforeTimes = this.times.filter(time => {
                    return now.isBetween(time.start.clone().subtract(5, 'minutes'), time.start);
                })

                const duringTimes = this.times.filter(time => {
                    return now.isBetween(time.start, time.end);
                })

                if (!beforeTimes.length && !duringTimes.length) {
                    this.timeString = 'Not yet.';
                }

                else if (duringTimes.length) {
                    this.timeString = 'YES';
                    this.isFika = true;
                }

                else if (beforeTimes.length) {
                    beforeTimes.forEach(time => {
                        const diff = moment.duration(time.start.diff(now));
                        this.isSoonFika = true
                        if (diff.minutes()) {
                            this.timeString = `No, but in ${diff.minutes()} minutes and ${diff.seconds()} seconds`;
                        } else {
                            this.timeString = `No, but in ${diff.seconds()} seconds`;
                        }
                    });
                }

                requestAnimationFrame(this.timer)
            },
            getTimes() {
                window.axios
                    .get(this.slug + '/times')
                    .then(res => res.data)
                    .then(data => {
                        data.forEach(time => {
                            this.times.push({
                                start: moment.tz(time.start, ['h:m a', 'H:m'], 'Europe/Stockholm'),
                                end: moment(time.end, ['h:m a', 'H:m'], 'Europe/Stockholm'),
                            });
                        });

                        requestAnimationFrame(this.timer)
                    });
            }
        }
    }
</script>
