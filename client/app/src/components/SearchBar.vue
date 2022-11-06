<template>

    <!-- Search bar -->
    <div class="input-group flex items-center px-3 lg:px-10 md:px-5 pt-4 flex items-center justify-end pr-6">
        <form @submit.prevent="onFormSubmit" class="flex items-center">
            <div class="relative w-full">
                <input type="text" v-model="searchKey" class="form-control relative flex-auto min-w-0 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-white focus:outline-none" placeholder="Search By Post Name" aria-label="Search" aria-describedby="button-addon2">
            </div>
            <div class="input-group-prepend">
                <button :disabled="emptySearch"  @click="search()"  class="p-2.5 ml-2 text-sm font-medium text-black bg-white rounded-lg border border-gray-300 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <span class="sr-only">Search</span>
                </button>
            </div>
        </form>
    </div>

</template>

<script>
export default {
    data () {
        return {
            error: null,
            searchKey: this.searching,
            disabledSearch: false,
        }
    },
    methods: {
        async search() {
            await this.$axios.get('/post/search?search=' + this.searchKey)
                .then(response => {
                    console.log('searchKey: ' + this.searchKey);
                    this.post_searches = response.data.data;
                    console.log(this.post_searches.length);
                    this.onFormSubmit();
                    this.$router.go(0);
                });
        },
        onFormSubmit() {
            this.$router.push({
                name: 'post.search',
                params: {searchKey: this.searchKey}
            });
        }
    },
    computed: {
        emptySearch(){
            return this.searchKey === ''
        },
        post_search(){
            return this.post_searches.length
        },
        searching(){
            return this.$route.params.searchKey
        },
    },
}
</script>
