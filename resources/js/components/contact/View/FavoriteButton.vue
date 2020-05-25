<template>
    <span v-on:click="toggleFavorite()"
          class="card-header-btn fav-header-btn"
          v-bind:class="[
            isInProcess ? 'is-in-process' : ''
          ]"
    >
        <span class="fav-text">{{ text }}</span>
        <i
            class="fav-icon"
            v-bind:class="[
                (isFavorite && !isInProcess) ? 'is-favorite fas fa-star' : '',
                (!isFavorite && !isInProcess) ? 'far fa-star' : '',
                isInProcess ? 'fa-circle-notch fas fa-spin' : ''
            ]"
        ></i>
    </span>
</template>

<script>
    export default {
        mounted() {
        },

        props: {
            contactId: String,
            apiToken: String,
            initIsFavorite: Boolean,
            textMarked: String,
            textUnmarked: String
        },

        computed: {
            text: function() {
                return (this.isFavorite) ? this.textMarked : this.textUnmarked;
            }
        },

        data: function() {
            return {
                isFavorite: this.initIsFavorite,
                isInProcess: false
            }
        },

        methods: {
            toggleFavorite: function() {
                this.isInProcess = true;

                // Update is_favorite property of contact
                axios.put('/api/contacts/' + this.contactId, {
                        'api_token': this.apiToken,
                        id: this.contactId,
                        'is_favorite': !this.isFavorite
                    })
                    .then(response => {
                        this.isInProcess = false;
                        if ('is_favorite' in response.data) {
                            // Strict boolean
                            this.isFavorite = (response.data['is_favorite']) ? true : false;
                        }
                    })
                    .catch(e => {
                        this.isInProcess = false;
                        console.log(e);
                    });

                return 'Wow!';
            }
        }
    }
</script>
