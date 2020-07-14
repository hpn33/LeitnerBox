<template>

    <div class="card">
        <div class="card-header d-flex ">
            <a class="flex-grow-1" :href="'/decks/' + deck_id">Back</a>
            {{ index + 1 }}/{{ cards.length }}
        </div>

        <div class="card-body text-center">
            <p>
                {{ card.front }}
            </p>
            <hr>
            <p>
                {{ card.back }}
            </p>
        </div>

        <!--        <div class="card-footer d-flex justify-content-end">-->
        <!--            {{ $cards->links() }}-->
        <!--        </div>-->

        <div class="d-flex justify-content-center">
            <a class="btn" slot="prev-nav" @click="first()">First</a>
            <a class="btn" slot="prev-nav" @click="tenPrev()">-10</a>
            <a class="btn" slot="prev-nav" @click="prev()">-1</a>
            <a class="btn" slot="prev-nav" @click="center()">Center</a>
            <a class="btn" slot="next-nav" @click="next()">+1</a>
            <a class="btn" slot="next-nav" @click="tenNext()">+10</a>
            <a class="btn" slot="next-nav" @click="last()">Last</a>
        </div>
    </div>


</template>


<script>
    export default {
        props: ['deck_id'],
        mounted() {

            axios.get('/review/' + this.deck_id)
                .catch((e) => {
                    console.log(e)
                })
                .then((r) => {
                    this.cards = r.data.cards
                    this.index = 0

                    this.setCard()
                    console.log(this.cards)
                });
        },

        data() {
            return {
                cards: [],
                card: {},
                index: 0
            }
        },

        methods: {

            checkIndex() {
                if (this.index < 0) {
                    this.index = 0
                } else if (this.index > this.cards.length) {
                    this.index = this.cards.length - 1
                }
            },

            first() {
                this.index = 0
                this.setCard()
            },

            last() {
                this.index = this.cards.length - 1
                this.setCard()
            },

            center() {
                this.index = this.cards.length /2 - 1
                this.setCard()
            },

            next() {
                this.index++
                this.setCard()
            },

            tenNext() {
                this.index += 10
                this.setCard()
            },

            prev() {
                this.index--

                this.setCard()
            },
            tenPrev() {
                this.index -= 10
                this.setCard()
            },

            setCard() {
                this.checkIndex()

                this.card = this.cards[this.index]
            }
        }
    }
</script>
