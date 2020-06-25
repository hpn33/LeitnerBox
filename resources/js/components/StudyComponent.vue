<template>


    <div class="card">
        <div class="card-header d-flex flex-row">
            <div class="flex-grow-1">
                <a :href="'/decks/' + deck_id">Back to Deck</a>
            </div>
        </div>

        <div class="card-body text-center">
            <p v-text="card.front"></p>
            <hr>
            <p v-show="show" v-text="card.back"></p>
        </div>


        <div class="card-footer d-flex justify-content-center">
            <a v-show="!show"
               @click="toggle()"
               class="btn" href="#">Show Answer</a>


            <a v-show="show" class="btn" @href="deck_path + 'study/' + card.id + '?p=again'">again</a>

            <a v-show="show" class="btn" @href="deck_path + 'study/' + card.id + '?p=good'">good</a>

            <a v-show="show" class="btn " @href="deck_path + 'study/' + card.id + '?p=easy'">easy</a>
        </div>
    </div>


</template>


<script>
    export default {
        props: ['deck_id'],
        mounted() {

            axios.post('/study/' + this.deck_id)
                .catch((e) => {
                    console.log(e)
                })
                .then((r) => {
                    this.card = r.data.card
                });
        },

        data() {
            return {
                card: {
                    front: '',
                    back: ''
                },
                show: false
            }
        },

        methods: {

            toggle() {
                this.show = !this.show
            }
        }


    }
</script>
