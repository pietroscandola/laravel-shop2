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
      <Card
        @on-product-in-cart="setCart"
        v-for="product in products"
        :key="product.id"
        :product="product"
      />
    </div>
  </div>
</template>

<script>
import Card from "./Card.vue";

export default {
  name: "App",
  components: { Card },
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

    setCart(cart) {
      this.cart.push(cart);
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
