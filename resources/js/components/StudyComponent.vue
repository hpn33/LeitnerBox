<template>


    <div class="card">
        <div class="card-header d-flex flex-row">
            <div class="flex-grow-1">
                <a :href="'/decks/' + deck_id">Back to Deck</a>
            </div>

            <div v-show="power" class="d-flex flex-row">
                <p class="text-info">{{ status.new }}</p>
                <p class="text-danger">{{ status.again }}</p>
                <p class="text-success">{{ status.success }}</p>
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
                    // this.cards = r.data.cards

                    for (const key in Object.keys(r.data.cards)) {
                        this.cards.push(r.data.cards[key])
                    }

                    this.show_answer_btn = true
                    this.power = true

                    this.readyCard()
                });
        },

        data() {
            return {
                cards: [],
                card: {id: 0, front: '', back: '', state: 0, again: false},
                // index: 0,
                power: false,
                show: false,
                show_answer_btn: false,

                status: {
                    new: 0,
                    again: 0,
                    success: 0,

                    reset() {
                        this.new = 0
                        this.again = 0
                        this.success = 0
                    }
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
                this.show_answer_btn = true

                Object.assign(this.card, this.cards.shift())

                // this.card = Object.keys(this.card).reduce((data, key) => {
                //     data[key] = this.cards[this.index][key]
                //     return data;
                // }, {});

            },

            // nextCard() {
            //     // this.index++
            //
            //     this.readyCard()
            //
            // },

            setStatus() {

                this.status.reset()

                for (const index in Object.keys(this.cards)) {
                    let card = this.cards[index]

                    if (card.state == 0)
                        this.status.new++

                    else if (card.again == true)
                        this.status.again++

                    else
                        this.status.success++

                }

            },

            again() {

                this.cards.push(this.card)

                this.readyCard()
            },

            good() {

                this.cards.push(this.card)

                this.readyCard()
            },

            easy() {

                this.readyCard()
            }

        }
    }
</script>
