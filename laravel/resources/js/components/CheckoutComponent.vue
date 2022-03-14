<template>
    <div class="item-container container my-3">
        <h1 class="checkout__title p-3">Elabs Consulting Test</h1>
        <div class="row container">
            <div class="col-12 my-2">
                <label for="item-id">Search Item</label>
                <input placeholder="Item Id" v-model="itemId" id="item-id" class="input__search">
                <button @click="fetchById" type="submit" class="btn btn-outline-warning">Search</button>
            </div>
            <div class="col-6 mt-3">
                <div class="container item-info__details p-4 rounded">
                    <h2 class="my-3 mx-2">Item Details</h2>
                    <div class="col-12 mx-2">
                        <div>
                            <img v-if="itemById" :src="itemById.image" class="item__img img-fluid rounded" alt="item-img" />
                            <h3 v-if="itemById" class="my-2">{{itemById.brand + itemById.model}}</h3>
                            <p v-else class="mt-5">No Item yet</p>
                        </div>
                        <div class="col-6">
                            <div>
                                <div class="card-body">
                                    <div class="card-text">
                                        <h4>Color</h4>
                                        <p v-if="itemById">{{itemById.color}}</p>
                                        <p v-else>No Item yet</p>
                                    </div>
                                    <div class="card-text">
                                        <h4>Material</h4>
                                        <p v-if="itemById">{{itemById.material}}</p>
                                        <p v-else>No Item yet</p>
                                    </div>
                                    <div class="card-text">
                                        <h4>Price</h4>
                                        <p v-if="itemById">{{itemById.price}}€</p>
                                        <p v-else>No Item yet</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 mt-3">
                <div class="container item-info__summary p-4 rounded">
                    <h2 class="my-3 mx-2">Summary</h2>
                    <div class="col-12 mx-2">
                        <div class="row">
                            <div class="col-4">
                                Price
                            </div>
                            <div class="col-8">
                                <p v-if="itemById">{{itemById.price}}€</p>
                                <p v-else>No Item yet</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                Taxes (21%)
                            </div>
                            <div class="col-8">
                                <p v-if="itemById">{{itemTax}}€</p>
                                <p v-else>No Item yet</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 bold">
                                Total:
                            </div>
                            <div class="col-8">
                                <p v-if="itemById">{{itemTotal}}€</p>
                                <p v-else>No Item yet</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";
    export default {
        name: 'CheckoutComponent',
        data() {
            return {
                items: [],
                itemById: null,
                itemId: 0,
                itemTax: 0,
                itemTotal: 0,
            }
        },
        mounted() {
            console.log('Component mounted.');
            this.showItems();
            
        },
        methods: {
            async showItems(){
                try {
                    const response = await axios.get('/api/getItems')
                    this.items = response.data;
                    // In case we want to save in local storage to don't make so many calls 
                    // const parsed = JSON.stringify(this.items);
                    // localStorage.setItem('items', parsed);
                }catch {
                    console.log("no items")
                }
            },
            async fetchById(){
                console.log("dentro de fetchbyid" + this.itemId);
                this.calculateTax();
                try {
                    const response = await axios.get(`/api/getItem/${this.itemId}`)
                    this.itemById = response.data;
                    console.log(this.itemById.color)
                }catch {
                    console.log("This item doesn't exist");
                }
            },
            async calculateTax(){
                try {
                    const response = await axios.get(`/api/calculateTax/${this.itemId}`)
                    this.itemTax = (response.data*21)/100;
                    this.itemTotal = response.data + this.itemTax;
                }catch {
                    console.log("This item doesn't exist")
                }
            }
            // Saving in localStorage we can manage the info in a way we don't need to execute that amount of calls, calling the database by pages for example
        }
    }
</script>


