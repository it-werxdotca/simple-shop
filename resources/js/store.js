import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        basket: {}
    },
    mutations: {
        SET_BASKET (state,contents) {
            state.basket = contents
        }
    },
    actions: {
        async updateCart(state,contents){
            let basket = contents
            try {
                const response = await axios.post("/cart", {items:contents})
                basket = response.data
            }
            catch (e) {
                alert("Update failed, try again later")
            }
            finally {
                state.commit("SET_BASKET",basket)
            }
            return basket
        },
        async syncCart(state){
            let basket = {}
            try {
                const response = await axios.get("/cart")
                basket = response.data
            }
            catch (e) {
                alert("Update failed, try again later")
            }
            finally {
                state.commit("SET_BASKET",basket)
            }
        }
    }
})

export default store