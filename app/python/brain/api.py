
# Get EA data
ea = open("../ea/eaFetchApi.py")

# Get AZ data
az = open("../az/azFetchApi.py")

# Run them
print("...Fetching EA data")
exec(ea.read())
print("...EA data complete !")

print("...Fetching Azure Reserved data")
exec(az.read())
print("...AZ Reserved data complete !")

# End
print("...DONE !!!")