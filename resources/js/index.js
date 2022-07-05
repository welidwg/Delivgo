import { createRoot } from "react-dom/client";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import Index from "./Main/pages";
import "jquery";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap/dist/js/bootstrap.bundle";
const container = document.getElementById("body");
const root = createRoot(container);

root.render(
    <BrowserRouter>
        <Routes>
            <Route path="/" element={<Index />} />
        </Routes>
    </BrowserRouter>
);
