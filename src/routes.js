import index from "./components/share/Index"
import single from "./components/share/Single"
export const routes = [
    {
        path: rtwp.base_path,
        name: 'index',
        component: index,
    },
    {
        path: rtwp.base_path + ":name",
        name: "single",
        component: single
    }
];
