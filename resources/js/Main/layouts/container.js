import Header from "../Components/header";

const Container = (props) => {
    return (
        <div>
            <Header />
            {props.children}
        </div>
    );
};

export default Container;
