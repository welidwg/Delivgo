const Navbar = (props) => {
    return (
        <>
            <nav class="navbar navbar-dark sticky-top navbar-expand-md navigation-clean-search">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        BBBOOTSTAP
                    </a>
                    <button
                        data-bs-toggle="collapse"
                        class="navbar-toggler"
                        data-bs-target="#navcol-1"
                    >
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <ul class="nav navbar-nav">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="#">
                                    Contact
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a
                                    class="dropdown-toggle nav-link"
                                    data-toggle="dropdown"
                                    aria-expanded="false"
                                    href="#"
                                >
                                    Services
                                </a>
                                <div class="dropdown-menu" role="menu">
                                    <a
                                        class="dropdown-item"
                                        role="presentation"
                                        href="#"
                                    >
                                        Logo design
                                    </a>
                                    <a
                                        class="dropdown-item"
                                        role="presentation"
                                        href="#"
                                    >
                                        Banner design
                                    </a>
                                    <a
                                        class="dropdown-item"
                                        role="presentation"
                                        href="#"
                                    >
                                        content writing
                                    </a>
                                </div>
                            </li>
                        </ul>
                        <form class="form-inline mr-auto" target="_self">
                            <div class="form-group">
                                <label for="search-field">
                                    <i class="fa fa-search text-white"></i>
                                </label>
                                <input
                                    class="form-control search-field"
                                    type="search"
                                    id="search-field"
                                    name="search"
                                />
                            </div>
                        </form>
                        <span class="navbar-text">
                            {" "}
                            <a class="login" href="#">
                                Log In
                            </a>
                        </span>
                        <a
                            class="btn btn-light action-button"
                            role="button"
                            href="#"
                        >
                            Signup
                        </a>
                    </div>
                </div>
            </nav>
        </>
    );
};

export default Navbar;
