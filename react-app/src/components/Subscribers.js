import React, {Component} from 'react';
import apiUrl from '../config/config';
import {NavLink} from 'react-router-dom';
class Subscribers extends React.Component {
    constructor() {
        super();
        this.state = {
          usersData: [],
          error: null,
          selectedUser: null
        };
      }
      render() {
        const usersList = this.state.usersData.map(user => {
          return <tr align="left">
              <td width="40%" key={user.id} onClick={()=>this.handleClick(user.id)}>{user.name}</td>
              <td width="40%" key={user.id} onClick={()=>this.handleClick(user.id)}>{user.email}</td>
              </tr>
        })
        return (
          <>
          <div className="wrapper">
            <div className="UserList">
                <NavLink lassName="navbar-item" to="/subscribe"> New Subscriber</NavLink>
              <h1>Subscribers</h1>
              <table align="center">
                  <tr align="left"><td width="40%"><b>Name</b></td><td width="40%"><b>Email</b></td></tr>
                  {usersList}
                </table>

            </div>
            </div> 
          </>
        );
      }
    
      componentDidMount() {
        fetch(apiUrl+'subscribers')
          .then(response => response.json())
          .then(data => {
            this.setState({usersData: data.data})
            })
          .catch(err => this.setState({error: err.message}))
      }
    
  }
  export default Subscribers;