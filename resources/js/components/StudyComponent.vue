<template>


    <div class="card">
        <div class="card-header d-flex flex-row">
            <div class="flex-grow-1">
                <a :href="'/decks/' + deck_id">Back to Deck</a>
            </div>

            <div class="d-flex flex-row">
                <p v-show="power" class="text-info" v-text="status.new"></p>
                <p v-show="power" class="text-danger" v-text="status.again"></p>
                <p v-show="power" class="text-success" v-text="status.success"></p>
            </div>

        </div>

        <div class="card-body text-center">
            <p v-text="card.front"></p>
            <hr>
            <p v-show="show" v-text="card.back"></p>
        </div>


        <div class="card-footer d-flex justify-content-center">
            <a v-show="show_answer_btn"
               @click="showAnswer()"
               class="btn" href="#">Show Answer</a>


            <a v-show="show" class="btn" @click="again()">again</a>

            <a v-show="show" class="btn" @click="good()">good</a>

            <a v-show="show" class="btn " @click="easy()">easy</a>
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

                    let cards = r.data.cards


                    this.cards = [].concat(
                        cards.filter(card => card.state == 0),
                        cards.filter(card => card.state != 0 && !card.again),
                        cards.filter(card => card.again))


                    this.show_answer_btn = true
                    this.power = true

                    this.readyCard()
                });
        },

        data() {
            return {
                cards: [],
                card: {},

                power: false,
                show: false,
                show_answer_btn: false,

                status: {
                    new: 0,
                    again: 0,
                    success: 0
                }

            }
        },

        methods: {

            showAnswer() {
                this.show = true
                this.show_answer_btn = false
            },

            readyCard() {

                this.setStatus()
                this.show = false

                if (this.cards.length != 0) {

                    this.show_answer_btn = true
                    this.card = this.cards.shift()
                    return
                }

                this.power = false
                this.card = {}

            },

            setStatus() {

                this.status.new = 0
                this.status.again = 0
                this.status.success = 0


                for (const index in Object.keys(this.cards)) {

                    let card = this.cards[index]


                    if (card.again)
                        this.status.again++

                    else if (card.state == 0)
                        this.status.new++

                    else
                        this.status.success++

                }


            },

            again() {

                this.card.again = true

                if (this.card.state > 0)
                    this.card.state--

                this.cards.push(this.card)

                this.readyCard()
            },

            good() {

                this.cards.push(this.card)

                this.readyCard()
            },

            easy() {

                this.card.state++

                axios.post('/study/' + this.card.id, this.card)
                    .catch((e) => {
                        console.log(e)
                    })
                    .then(r => {

                        if (r.data)
                            console.log(r.data)
                    })

                this.readyCard()
            }

        }
    }
</script>
