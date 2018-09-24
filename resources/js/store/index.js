import Vue from "vue";
import Vuex from "vuex";

const order = {
	state: {
		order: []
	},
	mutations: {},
	actions: {}
};

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== "production";

export default {
	modules: {
		order
	},
	strict: debug,
	plugins: debug ? [createLogger()] : []
};
