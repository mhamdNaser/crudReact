import React from "react";
import Container from 'react-bootstrap/Container';
import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar';


class Header extends React.Component{
    render(){
        return(
            <div>
                <Navbar collapseOnSelect expand="lg" bg="dark" variant="dark">
                    <Container>
                        <Navbar.Brand href="#home">React-Bootstrap</Navbar.Brand>
                        <Nav className="me-auto">
                            <Nav.Link href="/">User</Nav.Link>
                            <Nav.Link href="main">Main</Nav.Link>
                            <Nav.Link href="create">Create</Nav.Link>
                        </Nav>
                    </Container>
                    </Navbar>
            </div>
        )
    }
}

export default Header