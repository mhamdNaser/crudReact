import React from "react"
import Button from 'react-bootstrap/Button';
import Card from 'react-bootstrap/Card';

function Main(props) {
  console.log(props.message);
  return (
    <div className="row d-flex vh-75 p-5 m-5 justify-content-center">
        {props.message.map(el => (
            <Card className="col-lg-3 ms-5 me-5" style={{ width: '20rem' }}>
            <Card.Img variant="top" src={el.bookImage} alt="nnj" style={{ height: '180px'}} />
            <Card.Body>
                <Card.Title>{el.Title}</Card.Title>
                <Card.Text>{el.author}</Card.Text>
                <Card.Text>{el.description}</Card.Text>
                <Button variant="primary">Go somewhere</Button>
            </Card.Body>
            </Card>
        ))}
    </div>
  );
}

export default Main;