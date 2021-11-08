<template>
    <div class="container mt-5">
        <div class="row">
            <!---------------------------------------- form category section----------------------------------------------------- -->
            <div class="col-6">
                <h2 class="text-center text-secondary">add new category</h2>
                <div class="form-group">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="name"
                        name="nameC"
                        v-model="nameC"
                    />
                    <button
                        v-on:click="addCategory()"
                        class="btn btn-success form-control mt-2"
                    >
                        add
                    </button>
                </div>
            </div>
            <!---------------------------------------- end form category section----------------------------------------------------- -->


            <!---------------------------------------- form product section----------------------------------------------------- -->

            <div class="col-6">
                <h2 class="text-center text-secondary">add new product</h2>
                <div class="form-group">
                    <input
                        type="text"
                        class="form-control mt-2"
                        placeholder="name"
                        name="nameP"
                        v-model="nameP"
                    />
                    <input
                        type="text"
                        class="form-control mt-2"
                        placeholder="price"
                        name="price"
                        v-model="price"
                    />
                    <input
                        type="text"
                        class="form-control mt-2"
                        placeholder="description"
                        name="description"
                        v-model="description"
                    />
                    <input
                        type="file"
                        id="file"
                        class="form-control mt-2"
                        placeholder="name"
                        @change="handleFileUpload($event)"
                    />
                    <select
                        name="category_id"
                        v-model="category_id"
                        id=""
                        class="form-control mt-2"
                    >
                        <option
                            v-for="category in categories"
                            :key="category.id"
                            :value="category.id"
                        >
                            {{ category.name }}
                        </option>
                    </select>
                    <button
                        v-on:click="addNewProduct()"
                        class="btn btn-success form-control mt-2"
                    >
                        add
                    </button>
                </div>
            </div>

            <!----------------------------------------end form product section----------------------------------------------------- -->

        </div>





        <div class="row mt-5">
            <!----------------------------------------display category section----------------------------------------------------- -->
            <div class="col-md-3">
                <h3 class="text-secondary text-center fw-bold">
                    categories list
                </h3>
                <ul class="list-group">
                    <li
                        class="list-group-item"
                        v-for="category in categories"
                        :key="category.id"
                    >
                        {{ category.name }}
                        <button
                            v-on:click="deleteCategory(category.id)"
                            class="btn btn-danger float-end"
                        >
                            delete
                        </button>
                    </li>
                </ul>
            </div>
            <!---------------------------------------- end display category section----------------------------------------------------- -->



            <!---------------------------------------- display products  section----------------------------------------------------- -->

            <div class="col-md-9">
                <div
                    class="card mt-2"
                    v-for="product in products"
                    :key="product.id"
                >
                    <span v-for="image in product.images" :key="image.id">
                        <img
                            style="width: 200px; height: 200px"
                            :src="'/storage/' + image.path"
                            class="card-img-top"
                        />
                    </span>
                    <div class="card-body">
                        <h5 class="card-title">{{ product.title }}</h5>
                        <p class="card-text">
                            {{ product.description }}
                        </p>
                        <button
                            v-on:click="deleteProduct(product.id)"
                            class="btn btn-danger float-end"
                        >
                            delete
                        </button>
                    </div>
                </div>
            </div>

            <!---------------------------------------- end display product  section----------------------------------------------------- -->

        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            // products attributes
            products: [],
            file: "",
            price: "",
            description: "",
            category_id: "",
            nameP: "",


            // category attributes
            categories: [],
            nameC: "",
        };
    },


    // trigget products and category methods
    mounted() {
        this.loadProducts();
        this.loadCategories();
    },


    methods: {

        // -----------------------------------product part-----------------------------------------
        // handle file input with this function
        handleFileUpload: function (event) {
            this.file = event.target.files[0];
        },


// load products 
        loadProducts: function () {
            axios.get("/api/products").then(({ data: { products } }) => {
                this.products = products;
                console.log(this.products);
            });
        },

// delete product
        deleteProduct: function (id) {
            axios.delete("/api/deleteProduct/" + id).then((res) => {
                console.log(res);

                this.loadProducts();
            });
        },

// add new product
        addNewProduct: function () {
            // using form data object to handle files and data together
            let formData = new FormData();
            formData.append("photo", this.file);
            formData.append("name", this.nameP);
            formData.append("price", this.price);
            formData.append("description", this.description);
            formData.append("category_id", this.category_id);

            axios.post("/api/addNewProduct", formData).then((res) => {
                this.loadProducts();
                console.log(res);
            });
        },




        // -----------------------------------category part-----------------------------------------

        // load categories
        loadCategories: function () {
            axios.get("/api/categories").then(({ data: { categories } }) => {
                this.categories = categories;
                console.log(this.categories);
            });
        },


       // add new category
        addCategory: function () {
            // alert(this.nameC);
            axios
                .post("/api/addNewCategory", { name: this.nameC })
                .then((res) => {
                    console.log(res);

                    this.loadCategories();
                });
        },


    // delete category
        deleteCategory: function (id) {
            axios.delete("/api/deleteCategory/" + id).then((res) => {
                console.log(res);

                this.loadCategories();
            });
        },
    },
};
</script>
