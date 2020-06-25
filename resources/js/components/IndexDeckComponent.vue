<template>

    <div>
        <div class="row row-cols-3">

            <div v-for="deck in laravelData.data" :key="deck.id" class="col">
                <div class="card m-1">
                    <div class="card-body card-text text-center h-100">

                        <a :href="'/decks/'+deck.id"><h5>{{ deck.name }}</h5></a>

                    </div>
                </div>
            </div>


        </div>

        <div class="d-flex justify-content-center">
            <pagination :data="laravelData" :limit="3" @pagination-change-page="getResults">
                <span slot="prev-nav">&lt; Previous</span>
                <span slot="next-nav">Next &gt;</span>
            </pagination>
        </div>
    </div>


</template>

<script>
    export default {
        data() {
            return {
                // Our data object that holds the Laravel paginator data
                laravelData: {},
            }
        },

        mounted() {
            // Fetch initial results
            this.getResults();
        },

        methods: {
            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                axios.get('/decks/index/results?page=' + page)
                    .then(response => {
                        console.log(response)
                        this.laravelData = response.data;
                    });
            }
        }
    }
</script>
