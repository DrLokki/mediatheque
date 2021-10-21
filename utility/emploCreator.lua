local luasql = require("luasql.postgres")
local env = assert (luasql.postgres())
local con = assert (env:connect("media_db","ulna","radius2","localhost"))
local user = {last_name='',email='',id=0} 
local emplo = {}
local response

io.write("Entré votre nom (attention respecter les majuscules): ")
user.last_name = io.read()
io.write("Entré votre email : ")
user.email = io.read()
io.write("Entré votre id : ")
user.id = io.read()

response = assert(con:execute(string.format(
	[[SELECT name,role FROM users WHERE id=%s AND last_name='%s' AND email='%s']], 
	user.id,user.last_name,user.email)))

response:fetch(user, "a")
response:close()

print(user.role)

if user.role == 'admin' then
	print("vous êtez connecter en tant que : "..user.name.." "..user.last_name)
	io.write("entré l'id du profile a passer en employer : ")
	emplo["id"] = io.read()
	local res = assert(con:execute(string.format(
		[[UPDATE users SET role='employer' WHERE id=%s]],
		emplo.id)))
	response = assert(con:execute("SELECT name,last_name FROM users WHERE id="..emplo.id))
	response:fetch(emplo, "a")
	response:close()
	print("vous avez donner les droit employer à "..emplo["name"].." "..emplo["last_name"])
end

con:close()
env:close()