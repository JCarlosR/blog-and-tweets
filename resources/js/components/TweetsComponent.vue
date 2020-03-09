<template>
    <ul class="list-group list-group-flush">
        <li class="list-group-item" v-for="(tweet, index) in tweets" :key="tweet.id_str">
            <p><small>{{ tweet['created_at'] }}</small></p>
            <p>{{ tweet['text'] }}</p>

            <button v-if="tweet['hidden']" @click="hideTweet(index, tweet.id_str, false)" class="btn btn-sm btn-primary" type="button">
                Un-hide tweet
            </button>
            <button v-else @click="hideTweet(index, tweet.id_str)" class="btn btn-sm btn-primary" type="button">
                Hide tweet
            </button>
        </li>

        <li class="list-group-item">
            <a :href="`/twitter/logout`" class="btn btn-primary">
                Disconnect your Twitter account
            </a>
        </li>
    </ul>
</template>

<script>
    export default {
        data() {
            return {
                tweets: [
                    // {id: 123, created_at: '17/07/2020', hidden: false}
                ],
            };
        },

        mounted() {
            this.fetchTweets();
        },

        methods: {
            fetchTweets: function() {
                // console.log('fetchTweets method called');

                axios.get('/api/tweets')
                .then(response => {
                    // console.log(response);
                    this.tweets = response.data;
                }).catch(err => {
                    console.log(err);
                })
            },

            hideTweet: function (index, tweetId, hidden = true) {
                // Caution: use tweet.id_str instead of tweet.id
                // In some cases the id ended up incomplete when performing the request from Vue
                // Apparently the last digit was cut when it was stored as a Vue property inside this.tweets

                // console.log('hideTweet', tweetId, hidden);

                let statusUrl;

                if (hidden)
                    statusUrl = `/api/tweets/status?hidden=1&id=${tweetId}`;
                else
                    statusUrl = `/api/tweets/status?hidden=0&id=${tweetId}`;

                // alert(statusUrl);

                axios.get(statusUrl)
                    .then(response => {
                        const tweet = this.tweets[index];
                        tweet['hidden'] = hidden;

                        this.$set(this.tweets, index, tweet); // update in reactive mode
                    }).catch(err => {
                    console.log(err);
                })
            }
        }
    }
</script>

<style scoped>

</style>
