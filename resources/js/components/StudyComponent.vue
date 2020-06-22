<template>


    <div class="card">
        <div class="card-header d-flex flex-row">
            <div class="flex-grow-1">
                <a @href="deck_path">Back to Deck</a>
            </div>
        </div>

        <div class="card-body text-center">
            <p v-text="card.front"></p>
            <hr>
            <p v-show="show" v-text="card.back"></p>
        </div>


        <div class="card-footer d-flex justify-content-center">
            <a v-show="show_toggle"
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
                    this.er = e
                })
                .then((r) => {
                    this.card = r.data.card
                });
        },

        data() {
            return {
                deck_path: '/decks/' + this.deck_id,
                card: {
                    front: '',
                    back: ''
                },
                er: {},
                show: false,
                show_toggle: true
            }
        },

        methods: {

            toggle() {
                console.log('here')
                this.show = !this.show
                this.show_toggle = !this.show_toggle
            }
        }


    }
</script>
