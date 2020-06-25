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
            <a v-show="show_toggle_btn"
               @click="toggle()"
               class="btn" href="#">Show Answer</a>


            <a v-show="show" class="btn" @click="nextCard()">again</a>

            <a v-show="show" class="btn" @click="nextCard()">good</a>

            <a v-show="show" class="btn " @click="nextCard()">easy</a>
        </div>
    </div>


</template>


<script>
    export default {
        props: ['deck_id'],
        mounted() {

            axios.get('/study/' + this.deck_id)
                .catch((e) => {
                    console.log(e)
                })
                .then((r) => {
                    this.cards = r.data.cards
                    this.show_toggle_btn = true

                    this.readyCard()
                });
        },

        data() {
            return {
                card: {id:0, front:'', back:'', state:0},
                index: 0,
                cards: {},
                show: false,
                show_toggle_btn: false
            }
        },

        methods: {

            toggle() {
                this.show = !this.show
                this.show_toggle_btn = !this.show_toggle_btn
            },

            readyCard() {

                // for (const x in arguments) {
                //     console.log(key)
                // }
                // this.card = this.cards[this.index]

                this.card.id = this.cards[this.index].id
                this.card.front = this.cards[this.index].front
                this.card.back = this.cards[this.index].back
                this.card.state = this.cards[this.index].state
            },

            nextCard() {
                this.index++
                this.readyCard()
            }
        }


    }
</script>
