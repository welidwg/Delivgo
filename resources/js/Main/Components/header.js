import Navbar from "./navbar";

const Header = (props) => {
    return (
        <>
            <div className="hero-blue">
                <Navbar />
                <div class="container hero">
                    <div class="row">
                        <div class="col-lg-9 mx-auto text-center">
                            <div class="hero-text">
                                <div class="">
                                    <p class="subtitle">
                                        Delivering good vibes
                                    </p>
                                    <h1>Delivgo</h1>
                                    <div class="hero-btns">
                                        <a
                                            href="restaurants.php"
                                            class="boxed-btn"
                                        >
                                            Restaurants
                                        </a>
                                        <a href="#footer" class="bordered-btn">
                                            Contact Us
                                        </a>
                                        <br />
                                        <br />
                                        <div class="">
                                            <form action="">
                                                <div class="input-group rounded-pill w-100 border-0 shadow sm bg-light justify-content-between align-items-center">
                                                    <button
                                                        type="submit"
                                                        class="btn fs-2 mx-2 bg-transparent border-none color-primary "
                                                    >
                                                        <i class="fas fa-map-marker-check"></i>{" "}
                                                    </button>
                                                    <input
                                                        type="text"
                                                        placeholder="What's your address?"
                                                        class="rounded-pill text-center  color-dark fw-bold px-5 bg-transparent form-control border-0 fs-4 shadow-none"
                                                    />
                                                    <button
                                                        type="submit"
                                                        class="btn d-none d-lg-flex  align-items-center justify-content-around  fs-5 fw-bold mx-2 bg-transparent border-none color-primary "
                                                    >
                                                        <i class="fas fa-location-circle fs-3"></i>
                                                        Use my location
                                                    </button>
                                                </div>
                                                <a class=" mt-2 color-primary fw-bold fs-4 d-block d-lg-none">
                                                    <i class="fas fa-location-circle fs-3"></i>
                                                    Use my location
                                                </a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
};

export default Header;
