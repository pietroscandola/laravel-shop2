<template>
  <div class="container">
    <!-- Select filter -->
    <div class="d-flex justify-content-between">
      <select
        v-model="selectedBrand"
        class="custom-select custom-select-lg mb-3 w-25"
        @change="getProducts"
      >
        <option value="" selected>Tutti i brand</option>
        <option v-for="brand in brands" :key="brand.id" :value="brand.id">
          {{ brand.name }}
        </option>
      </select>
      <div class="position-relative">
        <i class="fa-solid fa-cart-shopping fa-2x"></i>
        <span
          v-if="cart.length"
          class="badge badge-danger position-absolute"
          style="top: -3px; right: -4px"
        >
          {{ cart.length }}
        </span>
      </div>
    </div>

    <!-- ALL products -->
    <div class="row">
      <div class="col-4 py-3" v-for="product in products" :key="product.id">
        <div class="card" style="width: 18rem">
          <img :src="product.image" class="card-img-top" :alt="product.name" />
          <div class="card-body">
            <h5 class="card-title">{{ product.name }}</h5>
            <p class="card-text">
              {{ product.description }}
            </p>
            <p class="card-text text-muted">{{ product.price }}€</p>
          </div>
          <div
            v-if="product.brand"
            class="
              card-footer
              d-flex
              justify-content-between
              align-items-center
            "
          >
            <h5>
              <span :class="`badge badge-pill badge-${product.brand.color}`">{{
                product.brand.name
              }}</span>
            </h5>
            <div class="d-flex justify-content-between align-items-center">
              <i
                role="button"
                class="fa-solid fa-circle-minus fa-lg text-danger"
                @click="removeProductToCartArray(product.id)"
              ></i>
              <button
                class="btn btn-primary mx-1"
                @click="addProductToCartArray(product.id)"
              >
                <i class="fa-solid fa-cart-arrow-down"></i>
                <i class="fa-solid fa-cart-plus"></i>
              </button>
              <i
                role="button"
                class="fa-solid fa-circle-plus fa-lg text-success"
              ></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "App",
  data() {
    return {
      products: null,
      brands: null,
      selectedBrand: "",
      currentCart: 0,
      cart: [],
    };
  },
  methods: {
    getProducts() {
      axios
        .get(
          "http://127.0.0.1:8000/api/products?brand_id=" + this.selectedBrand
        )
        .then((res) => {
          this.products = res.data;
        })
        .catch((err) => {
          console.error(err);
        })
        .then(() => {});
    },

    getBrands() {
      axios
        .get("http://127.0.0.1:8000/api/brands")
        .then((res) => {
          this.brands = res.data;
        })
        .catch((err) => {
          console.error(err);
        })
        .then(() => {});
    },
    addProductToCartArray(id) {
      this.cart.push(id);
    },
    removeProductToCartArray(id) {
      const index = this.cart.indexOf(id);
      if (index >= 0) {
        this.cart.splice(index, 1); // 2nd parameter means remove one item only
      }
    },

    /* addProductToCart() {
      this.currentCart++;
    },
    removeProductToCart() {
      if (this.currentCart > 0) this.currentCart--;
    }, */
  },
  mounted() {
    this.getProducts();
    this.getBrands();
  },
};
</script>
