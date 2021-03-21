import React, {Component} from 'react';
import apiUrl from '../config/config';
import {NavLink} from 'react-router-dom';

export default class AddSubscriber extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            name: null,
            email: null,
            errors: {
                name: '',
                email: ''
            }
        };
    }


    handleValidation = (event) => {
        event.preventDefault();
        const {
            name,
            value
        } = event.target;
        let errors = this.state.errors;
        
        switch (name) {
            case 'name':
                errors.name =
                (value.match(/^[a-zA-Z ]+$/)) ?'' :'Invalid Name!';
                break;
            case 'email':
                errors.email =
                    validEmailRegex.test(value) ?'' :'Invalid Email!';
                break;

            default:
                break;
        }

        this.setState({
            errors,
            [name]: value
        });
    }

    handleSubmit = (event) => {
        event.preventDefault();
        if (validateForm(this.state.errors)) {
        fetch(apiUrl+"add-subscriber", {
          method: "POST",
          headers: {
            'Content-Type': 'application/json',
            Accept: 'application/json'
          },
          body: JSON.stringify({
        name: this.state.name,
        email: this.state.email
          })
        })
        .then(resp => {
            if(resp.status!=200){
                alert('Bad request');
            }else{
                alert('Successfully subscribed!')
            }
        })
        

        } else {
            console.error('Invalid Form')
        }
    }

    render() {
            const {
                errors
            } = this.state;
            return ( <div className = 'wrapper' >
                 <NavLink className="navbar-item" to="/">
                        Home
                    </NavLink>
                        <div className = 'form-wrapper'>
                        <h2> Subscribe to Your Newsletter</h2> 
                        <form onSubmit = {
                            this.handleSubmit
                        } noValidate >
                <div className = 'name' >
                <label htmlFor = "name" > Name: < /label> <input type = 'text' name = 'name' onChange = {
                    this.handleValidation
                }
                noValidate / > {
                    errors.name.length > 0 &&
                    <p><span className = 'error' > {
                        errors.name
                    } </span></p>} </div><p></p >

                    <div className = 'email' >
                    <label htmlFor = "email" > Email: < /label> 
                    <input type = 'email'
                    name = 'email'
                    onChange = {
                        this.handleValidation
                    }
                    noValidate / > {
                        errors.email.length > 0 &&
                        <span className = 'error' > {
                            errors.email
                        } </span>} 
                        </div><p></p >

                        <div className = 'submit' ><button> Subscribe </button> </div> 
                        </form> 
                        </div> 
                        </div>
                    );
                }
            }
            const validEmailRegex = RegExp(
                /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i
            );
            const validateForm = errors => {
                let valid = true;
                Object.values(errors).forEach(val => val.length > 0 && (valid = false));
                return valid;
            };