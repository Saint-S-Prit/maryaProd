
const express = require('express');
const app = express();

const cors = require('cors');
app.use(cors());
app.use(express.json()); 
const server = require('http').createServer(app);
const io = require('socket.io')(server, {
    cors:{origin :'http://localhost:8080', methods:['GET', 'POST','PUT', 'PATCH', 'DELETE']}
});

io.on('connection', (client) => {
    console.log('LIEN CONNECTION');
});


app.all('/api/v1.0/emit-user',async (req,res)=>{
    let user = req.body;
    console.log(req.body)
    io.emit('newUser',user)
    return  res.json({
        msg:'Ok',
        code:200,
    });
});


server.listen( 8088,'0.0.0.0',()=>{
    console.log('SERVER START on http://localhost:8088/api/v1.0/emit-user')
})
