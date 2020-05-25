<template>
    <span v-on:click="toggleFavorite()"
          class="contact-favorite contact-control-btn"
          v-bind:class="[
            isInProcess ? 'is-in-process' : ''
          ]"
    >
        <i
            v-bind:class="[
                (isFavorite && !isInProcess) ? 'is-favorite fas fa-star' : '',
                (!isFavorite && !isInProcess) ? 'far fa-star' : '',
                isInProcess ? 'fa-circle-notch fas fa-spin' : ''
            ]">
        </i>
    </span>
</template>

<script>
    export default {
        mounted() {
        },

        props: {
            contactId: String,
            apiToken: String,
            initIsFavorite: Boolean
        },

        data: function() {
            return {
                isFavorite: this.initIsFavorite,
                isInProcess: false
            }
        },

        methods: {
            toggleFavorite: function() {
                // If currently in progress - do not react
                if (this.isInProcess) {
                    return;
                }

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
