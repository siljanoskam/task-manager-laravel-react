import React, {Component} from 'react';

const Task = ({task}) => {
  debugger;
  if (!task) {
    return (
      <div className="single-task-wrapper">
        <h4>No task selected.</h4>
      </div>
    )
  }
  return (
    <div className="single-task-wrapper">
      <h3> {task.title} </h3>
      <p> {task.description} </p>
      <h4> Status: </h4>
      <p>{task.status ? 'Done' : 'Undone'}</p>
    </div>
  )
};

export default Task;
