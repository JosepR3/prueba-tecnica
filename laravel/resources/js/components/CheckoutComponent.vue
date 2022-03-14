<template>
    <div class="container item-container">
        <div class="row">
            <div class="col-12">
                <h1>Elabs Consulting Test</h1>
            </div>
            <div class="col-12">
                    <label for="item-id">Search Item</label>
                    <input placeholder="Search Item" v-model="itemId" id="item-id"></input>
                    <button @click="fetchById" type="submit" class="btn btn-warning">Search</button>
            </div>
            <div class="col-6 item-info">
                <div class="container item-info__details">
                    <h2>Item Details</h2>
                    <div class="col-12">
                        <div class="col-6">
                            <figure>
                                <img v-if="itemById" :src="itemById.image" class="figure-img img-fluid rounded" alt="item-img" />
                                <figcaption v-if="itemById" class="figure-caption">{{itemById.brand + itemById.model}}</figcaption>
                            </figure>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-text">
                                        <h4>Color</h4>
                                        <p v-if="itemById">{{itemById.color}}</p>
                                    </div>
                                    <div class="card-text">
                                        <h4>Material</h4>
                                        <p v-if="itemById">{{itemById.material}}</p>
                                    </div>
                                    <div class="card-text">
                                        <h4>Price</h4>
                                        <p v-if="itemById">{{itemById.price}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="container item-info__summary">
                    <h2>Summary</h2>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-4">
                                Price
                            </div>
                            <div class="col-8">
                                << put here the item price >>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                Taxes
                            </div>
                            <div class="col-8">
                                << put here the taxes from the calc request >>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 bold">
                                Total:
                            </div>
                            <div class="col-8">
                                << put here the total price from the calc request >>
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
                    const parsed = JSON.stringify(this.items);
                    localStorage.setItem('items', parsed);
                    console.log(this.items)
                }catch {
                    console.log("no items")
                }
            },
            async fetchById(){
                console.log("dentro de fetchbyid" + this.itemId)
                try {
                    const response = await axios.get(`/api/getItem/${this.itemId}`)
                    this.itemById = response.data;
                    console.log(this.itemById.color)
                }catch {
                    console.log("no items")
                }
            }
        }
    }
</script>
