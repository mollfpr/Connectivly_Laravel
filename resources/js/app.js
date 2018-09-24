require("./bootstrap");

import VueRouter from "vue-router";

/** Components */
import Home from "./components/home";
import Customer from "./components/customer/index";
import CustomerList from "./components/customer/list";
import CustomerCreate from "./components/customer/create";
import CustomerEdit from "./components/customer/edit";
import CustomerShow from "./components/customer/show";
import Product from "./components/product/index";
import ProductList from "./components/product/list";
import ProductCreate from "./components/product/create";
import ProductEdit from "./components/product/edit";
import SalesOrder from "./components/salesOrder/index";
import SalesOrderList from "./components/salesOrder/list";
import SalesOrderCreate from "./components/salesOrder/create";

const routes = [
	{
		path: "/",
		name: "homeIndex",
		component: Home
	},
	{
		path: "/sales-order",
		component: SalesOrder,
		children: [
			{
				path: "",
				name: "salesOrderList",
				component: SalesOrderList
			},
			{
				path: "create",
				name: "salesOrderCreate",
				component: SalesOrderCreate
			}
		]
	},
	{
		path: "/product",
		component: Product,
		children: [
			{
				path: "",
				name: "productList",
				component: ProductList
			},
			{
				path: "create",
				name: "productCreate",
				component: ProductCreate
			},
			{
				path: ":id/edit",
				name: "productEdit",
				component: ProductEdit
			}
		]
	},
	{
		path: "/customer",
		component: Customer,
		children: [
			{
				path: "",
				name: "customerList",
				component: CustomerList
			},
			{
				path: ":id",
				name: "customerShow",
				component: CustomerShow
			},
			{
				path: "create",
				name: "customerCreate",
				component: CustomerCreate
			},
			{
				path: ":id/edit",
				name: "customerEdit",
				component: CustomerEdit
			}
		]
	}
];

window.Vue = require("vue");

Vue.use(VueRouter);
const router = new VueRouter({ routes });

const app = new Vue({
	el: "#app",
	router
});
